const fs = require('fs');
const request = require('request');
const dotenv = require('dotenv');
const argv = key => {
  // Return true if the key exists and a value is defined
  if ( process.argv.includes( `--${ key }` ) ) return true;

  const value = process.argv.find( element => element.startsWith( `--${ key }=` ) );

  // Return null if the key does not exist and a value is not defined
  if ( !value ) return null;
  
  return value.replace( `--${ key }=` , '' );
}

let id = 0;
if (argv('id')) {
  id = argv('id');
}

let noloop = false;
if (argv('noloop')) {
  noloop = true;
}

let debug = false;
if (argv('debug')) {
    debug = true;
}

try {
    path = '.env';
    if (!fs.existsSync(path)) {
        //file exists
        path = '../../.env';
        if (!fs.existsSync(path)) {
            throw 'no .env';
        }
    } 
} catch(err) {
    throw err;
}

dotenv.config({ path: path });

if (debug) {
    console.log(process.env);
    console.log('id:',id);
    console.log('noloop:',noloop);
    console.log('path:',path);
    console.log('DB_HOST',process.env.DB_HOST)
}

var download = function(uri, filename, callback){
  request.head(uri, function(err, res, body){
    //console.log('content-type:', res.headers['content-type']);
    //console.log('content-length:', res.headers['content-length']);

    request(uri).pipe(fs.createWriteStream(filename)).on('close', callback);
  });
};

var mysql = require('mysql');
var con = mysql.createConnection({
    host: process.env.DB_HOST,
    port: process.env.DB_PORT,
    user: process.env.DB_USERNAME,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_DATABASE,
});

con.connect(function (err) {
    if (err) throw err;
});

(function loop() {
    setTimeout(function () {
        // execute script
        var date = new Date();
        var resultdata = 0;
        
        //"SELECT * FROM buyformes where status = '0'"
        let query = "SELECT * FROM buyformes where status = '0' or status is null";
        if (id) {
        query = "SELECT * FROM buyformes WHERE id='"+id+"'";
    }
    if (debug) {
            console.log('start = ' + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds());
            console.log('query:',query);
        }
        // con.query("SELECT * FROM buyformes where status = '0'", function (err, result, fields) {
        con.query(query, function (err, result, fields) {
            if (err) throw err;
            resultdata = result;
        });

        const Billplz = require('billplz');
        const billplz = new Billplz(process.env.BILLPLZ_TOKEN);

        const puppeteer = require('puppeteer');

        (async () => {
            const browser = await puppeteer.launch({
                headless: true,
                userDataDir: "./user_data"
            });
            for (let i = 0; i < resultdata.length; i++) {
                try {
                    var infos = await mercaricheck(browser, resultdata[i]['producturl'], resultdata[i]['id'], con);
                } catch (error) {
                    // code to run if there are any problems
                } finally {
                }
            }
            var date = new Date();
            //console.log('END = ' + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds());
            await browser.close();
            if (noloop) {
                process.stdout.write('{"success":"true","message":""}');
                process.exit();
            }
            // await browser.close();
        })();
loop()
  }, 15000); //9000 = 9000ms = 9s
}());

async function mercaricheck(browser, url, inquiryid, con) {

    const page = await browser.newPage();
    var pagestatus = 1;

    await page.goto(url, {
        waitUntil: 'networkidle2'
    });

    //check sold or not
    var status = 1;
    var btn = await page.$$('button');
    for (let btndetail of btn) {
        try {
            // //console.log( await ( await btndetail.getProperty( 'disabled' ) ).jsonValue() );
            soldornot = await (await btndetail.getProperty('disabled')).jsonValue();
            if (soldornot) {
                status = 4;
            }
        } catch (e) {
            //console.log(`Could not get the style number:`, e.message);
        }
    }

    // check price.
    var modalprice = 0;
    var sellprice = 0;
    var styleNumbers = await page.$$('mer-price');
    for (let styleNumber of styleNumbers) {
      //console.log('styleNumber',styleNumber)
        try {
            ////console.log( await ( await styleNumber.getProperty( 'value' ) ).jsonValue() );
            if (modalprice == 0) {
                modalprice = await (await styleNumber.getProperty('value')).jsonValue();
                sellprice = parseInt(parseInt(parseFloat(modalprice)*0.04)+'00');
            }
        } catch (e) {
            //console.log(`Could not get the style number:`, e.message);
        }
    }


    // check category
    var categorylink = '';
    var ahref = await page.$$('a');
    for (let href of ahref) {
        try {
            link = await (await href.getProperty('href')).jsonValue();
            if (link.includes("t3_category_id=")) {
                categorylink = link;
            }
        } catch (e) {
            //console.log(`Could not get the style number:`, e.message);
        }
    }

    // screenshot
    await page.screenshot({
      path: 'screenshot.png'
  });

  // get image
  var image = 0;
  var styleNumbers = await page.$$('article mer-item-thumbnail');
  for (let styleNumber of styleNumbers) {
      try {
          ////console.log( await ( await styleNumber.getProperty( 'value' ) ).jsonValue() );
          if (image == 0) {
            image = await (await styleNumber.getProperty('src')).jsonValue();
          }
      } catch (e) {
          //console.log(`Could not get the style number:`, e.message);
      }
  }
  // save image
  // download('https://static.mercdn.net/item/detail/orig/photos/m58070190360_1.jpg?1611957158', 'google.png', function(){
  //   //console.log('done');
  // });

  // get title
  var title = 0;
  var n = await page.$('mer-heading[data-testid="name"]');
  title = await (await n.getProperty('titleLabel')).jsonValue();

    var sql = "UPDATE buyformes SET title = '" + title + "', image = '" + image + "', status = " + status + ", takeprice = " + modalprice + ", sellprice = " + sellprice + " , categorylink = '" + categorylink + "' where id = '" + inquiryid + "'";
    if (debug) {
        // console.log('query:',query);
        console.log(sql);
    }

    con.query(sql, function (err, result) {
        if (err) throw err;
        //console.log(inquiryid + " record updated");
    });
    await page.close();
    return infos;
}

async function autoScroll(page) {
    await page.evaluate(async () => {
        await new Promise((resolve, reject) => {
            var totalHeight = 0;
            var distance = 100;
            var timer = setInterval(() => {
                var scrollHeight = document.body.scrollHeight;
                window.scrollBy(0, distance);
                totalHeight += distance;

                if (totalHeight >= scrollHeight) {
                    clearInterval(timer);
                    resolve();
                }
            }, 100);
        });
    });
}