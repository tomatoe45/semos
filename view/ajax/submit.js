function regData() {
  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var gender = document.getElementById("gender").value;
  var contact = document.getElementById("contact").value;
  var address = document.getElementById("address").value;
  var photo = document.getElementById("file").value;

  var dataString = ' fname= ' + fname + 
                   ' &lname= ' + lname + 
                   ' &gender= ' + gender + 
                   ' &contact= ' + contact + 
                   ' &address= ' + address + 
                   ' &file= ' + photo;

  if(fname = '') {
    alert("All Fields Required.");
  } else {
  $.ajax({
    type: 'POST',
    url: 'ajax/submit.php',
    data: dataString,
    cache: false,
    success: function(html) {
      alert(html);
    }
  });
}

  return false;

}