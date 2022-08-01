<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.css" rel="stylesheet"/>

<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.js"
></script>

<script type="text/javascript">
   
var url = "http://ipinfo.io/{{$_SERVER['REMOTE_ADDR']}}?token=4ea90b6207ed28";
var url = "http://ipinfo.io/111.90.141.167?token=4ea90b6207ed28";
// console.log(url);

var xhr = new XMLHttpRequest();
xhr.open("GET", url);

xhr.onreadystatechange = function () {
   if (xhr.readyState === 4) {
      console.log(xhr.status);
      // console.log(xhr.responseText);
      var r = jQuery.parseJSON(xhr.responseText);
      console.log(r.country.toLowerCase());

      $("#ipcountry").addClass("flag-"+r.country.toLowerCase());
   }};

xhr.send();


// <i id="ipcountry" class="flag"></i>
// <i id="ipcountry" class="flag flag-my"></i>

</script>