

document.querySelector("form").addEventListener("submit" , function(e){

const email = document.getElementById("email").value.trim();
const phone = document.getElementById("phone").value.trim();

const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
if(!emailRegex.test(email)){
    alert("Please enter a valid email address.");
    e.preventDefault();
    return;
}
const phoneRegex = /^\d{10}$/;
if (!phoneRegex.test(phone)) {
    alert("Please enter a valid 10-digit phone number.");
    e.preventDefault(); // Stop form submission
    return;
  }

});