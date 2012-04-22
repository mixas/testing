//return XMLHTTPRequest object
    function getXmlHttp(){
      var xmlhttp;
      try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
      } catch (e) {
        try {
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
          xmlhttp = false;
        }
      }
      if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
        xmlhttp = new XMLHttpRequest();
      }
      return xmlhttp;
    }
    
    //time for testing in minutes
    var test_time = 10;
    //get time from testing/left_time every second(ajax technology)
    function get_time(){
    	var req = getXmlHttp()
    	var statusElem = document.getElementById('clock_face');
    	req.onreadystatechange = function(){
    		if (req.readyState == 4) {
    			if(req.status == 200) {
    			     var unix_time = req.responseText;
                     var end_time = test_time - Math.ceil(Math.abs(unix_time/60));
                     if (end_time < 0){
                        location.href = 'http://localhost/onlinetest/index.php/testing/result';
                     }
    			     var left_time = test_time - Math.ceil(Math.abs(unix_time/60)) + ' minutes';
    			     if (end_time == 0){
    			         left_time = test_time*60-Math.abs(unix_time) + ' seconds';
                     }
                     statusElem.innerHTML = left_time;
    			}
    		}
    	}
    	req.open('GET', 'http://localhost/onlinetest/index.php/testing/left_time', true);  
    	req.send(null);
    }