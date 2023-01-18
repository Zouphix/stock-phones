// function addEvent(){
//     document.querySelectorAll(".more").forEach((element) => {
//         element.addEventListener("click", (event) => {
//             //add datas below a tr
//             let tr = event.target.parentNode.parentNode;
//             let td = tr.querySelector(".more");
//             let tr2 = document.createElement("tr");
//             let td2 = document.createElement("td");
//             td2.setAttribute("colspan", "4");
//             td2.innerHTML = "{{communiquant}}";
//             tr2.appendChild(td2);
//             tr.parentNode.insertBefore(tr2, tr.nextSibling);
//             td.innerHTML = "less";
//             td.classList.remove("more");
//             td.classList.add("less");
//             addEvent();
//         });
//     });
// }

// addEvent();


