// JavaScript Document
//toggle password to show or hide password
function togglePassword() {
	var pw = document.getElementById('password');
	var toggleBtn = document.getElementById('toggleBtn');
	if(pw.type == "password"){
		pw.type = "text";
		toggleBtn.value = "Hide";
	} else {
		pw.type = "password";
		toggleBtn.value = "Show";
	}
}

//Character remaining Counter
var maxAmount = 500;
    function textCounter(textField, showCountField) {
      if (textField.value.length > maxAmount) {
            textField.value = textField.value.substring(0, maxAmount);
            } 
            else {
            showCountField.value = maxAmount - textField.value.length;
            }
    }

//Real time clock
function renderTime() {
        
        var currentTime = new Date();
        var diem = "AM";
        var h = currentTime.getHours();
        var m = currentTime.getMinutes();
        var s = currentTime.getSeconds();
        
        if (h == 0) {
            h = 12;
        }  else if (h > 12){
            h = h - 12;
            diem = "PM"; 
        }
        if (h < 10) {
            h = "0" + h;
        }
        if (m < 10) {
            m = "0" + m;
        }
        if (s < 10) {
            s = "0" + s;
        }
        
        var myClock = document.getElementById('clockDisplay');
        myClock.textContent = h + ":" + m + ":" + s  + " " + diem;
        myClock.innerText = h + ":" + m + ":" + s  + " " + diem;
        setTimeout('renderTime()',1000);
      }
      renderTime();