/*document.addEventListener("DOMContentLoaded", () => {
   const registerForm = document.getElementById("registerForm");
   registerForm.addEventListener("submit", (event) => {
       event.preventDefault();
       let valid = true;
       const data = new FormData(registerForm);
       data.forEach((value, key) => {
            const [element] = document.getElementsByName(key);
            if(element.nodeName == "INPUT" && (element.type == "text" || element.type == "date")) {
                if(element.value.length == 0) {
                    element.nextElementSibling.style.display = "block";
                    element.nextElementSibling.innerHTML = "Заполните поле " + element.placeholder;
                    valid = false;
                }
            }
       });
       //if(valid) {
           const request = new XMLHttpRequest();
           request.onreadystatechange = () => {
               if (request.readyState = 4 && request.status == 200) {
                   //location.replace("/");
               }
           }
           const [{value}] = document.getElementsByName('_token');
           request.open("POST", `/register?_token=${value}`);
           request.send(data);
      // }
   });
});
*/
