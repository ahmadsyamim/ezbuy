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
                    //console.log(infos);
                } catch (error) {
                    // code to run if there are any problems
                } finally {
                    // con.query("SELECT * FROM buyformes where id = '"+resultdata[i]['id']+"'", function (err, result, fields) {
                    //   if (err) throw err;
                    //   //console.log('status is '+ result['0']['status']);

                    //     if (result['0']['status'] == 0) {

                    //         (async () => {

                    //             //console.log("SELECT * FROM users where id = '"+result['0']['user']+"'");
                    //             con.query("SELECT * FROM users where id = '"+result['0']['user']+"'", function (err, userdetail, fields) {

                    //           let name = "noname";
                    //           let email = "nonoemail@gmail.com";
                    //             if(userdetail.length != 0 ) {
                    //               //console.log("kahkah");
                    //               email = userdetail['0']['email'];
                    //               name = userdetail['0']['name'];
                    //             }

                    //                 //console.log(userdetail);
                    //                 billplz.create_bill({
                    //                   'collection_id': 'cjfpv4n1',
                    //                   'description': resultdata[i]['producturl'],
                    //                   'email': email,
                    //                   'name': name,
                    //                   'amount': infos['sellprice']*100, //RM5.50
                    //                   'callback_url': "http://127.0.0.1:8000/home",
                    //                   'redirect_url': "http://127.0.0.1:8000/home",
                    //                   // 'due_at': '2020-10-31'
                    //                 }, function(err, res) {
                    //                   //console.log(res)

                    //                   var sql = "UPDATE buyformes SET status = "+infos['status']+", takeprice = "+infos['takeprice']+", sellprice = "+infos['sellprice']+", billid = '"+res['id'] +", paymentlink = '"+res['url']+"' where id = '"+resultdata[i]['id']+"'";
                    //                   //console.log(sql);

                    //                   con.query(sql, function (err, result) {
                    //                     if (err) throw err;
                    //                     //console.log(resultdata[i]['id']+" records updated");
                    //                   });

                    //                   browser.close();
                    //                   // var urlbillplz = res['url'];
                    //                 })




                    //             });



                    //         })();

                    //     };

                    // });


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
    var styleNumbers = await page.$$('mer-price');
    for (let styleNumber of styleNumbers) {
      //console.log('styleNumber',styleNumber)
        try {
            ////console.log( await ( await styleNumber.getProperty( 'value' ) ).jsonValue() );
            if (modalprice == 0) {
                modalprice = await (await styleNumber.getProperty('value')).jsonValue();
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
  //console.log('image',image);

  // save image
  // download('https://static.mercdn.net/item/detail/orig/photos/m58070190360_1.jpg?1611957158', 'google.png', function(){
  //   //console.log('done');
  // });

  // get title
  var title = 0;
  var n = await page.$('mer-heading[data-testid="name"]');
  title = await (await n.getProperty('titleLabel')).jsonValue();

  // for (let styleNumber of styleNumbers) {
  //     try {
  //         if (title == 0) {
  //           // title = await (await styleNumber.getAttribute('title-label'));
  //           title = await (await styleNumber.getProperty('title-label')).jsonValue();
  //         }
  //     } catch (e) {
  //         //console.log(`Could not get the style number:`, e.message);
  //     }
  // }
  //console.log('title',title);


    //console.log(modalprice + ' ' + categorylink + ' ' + status);

    var sql = "UPDATE buyformes SET title = '" + title + "', image = '" + image + "', status = " + status + ", takeprice = " + modalprice + ", sellprice = " + modalprice + " , categorylink = '" + categorylink + "' where id = '" + inquiryid + "'";
    if (debug) {
        // console.log('query:',query);
        console.log(sql);
    }

    con.query(sql, function (err, result) {
        if (err) throw err;
        //console.log(inquiryid + " record updated");
    });


    await page.close();


    // infos = {
    //     "status": status,
    //     "takeprice": modalprice,
    //     "sellprice": (cleanmodalprice*0.04),
    //     // "sizes": sizes,
    //     // "pictures": pictures
    // };


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





// var url = 'https://www.mercari.com/jp/items/m85312982627/?_s=U2FsdGVkX19tzrTYdyf1fT5cAWoJhMhBY4gzJBTGqy_wH4VGtnjDAbKawQXzyXocwDu1jpCDU43vWE-2kMhz7-9o7hwBJZ1QsBpudMkHwQDiupUHsJkG_WrIyOJeyW3x';

// var productcode = url.substring(
//   url.lastIndexOf("mercari.com/jp/items") + 21,
//   url.lastIndexOf("/")
// );

//  //console.log(productcode);

// await page.goto('https://www.mercari.com/jp/transaction/buy/'+productcode+'/');

// await page.waitFor(2000);
// await page.click('button[data-test="transaction-buy-purchase"]');
// await page.waitFor(5000);