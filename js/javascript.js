
setInterval(myTimer, 1000);

function myTimer() {
  const date = new Date();
  document.getElementById("myTime").innerHTML = date.toLocaleTimeString('it-IT');
}
