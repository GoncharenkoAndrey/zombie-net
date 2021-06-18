document.addEventListener("DOMContentLoaded", () => {
   const hit = document.getElementById("hit");
   if(hit) {
       hit.addEventListener("click", (event) => {
           const token = document.getElementsByName('_token');
           const userId = document.getElementById("userId");
           const request = new XMLHttpRequest();
           request.onreadystatechange = () => {
               if (request.readyState == 4 && request.status == 200) {
                   this.checked = request.responseText;
               }
           }
           request.open("POST", "/changeHit");
           request.setRequestHeader("Content-Type", "application/json");
           request.setRequestHeader("X-CSRF-TOKEN", token[0].value);
           const data = {userId: userId.value, value: hit.checked};
           request.send(JSON.stringify(data));
       });
   }
});
