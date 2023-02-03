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




function addEvent(){
    document.querySelector("#moon").addEventListener("click", () => {
        console.log("click");
        document.querySelector(".divTable").classList.toggle("dark-mode-div-table");
        document.querySelector('body').classList.toggle("dark-mode-body");
        document.querySelectorAll('th').forEach((element) => {
            element.classList.toggle("dark-mode-th");
        });
        document.querySelectorAll('button').forEach((element) => {
            element.classList.toggle("dark-mode-btn");
        });

        document.querySelectorAll('tr').forEach((element) => {
            element.classList.toggle("dark-mode-tr");
        });

        document.querySelectorAll('.page-item.active .page-link').forEach((element) => {
            element.classList.toggle("dark-mode-page-item");
        });
        document.querySelectorAll('.pagination>li>a').forEach((element) => {
            element.classList.toggle("dark-mode-page-link");
            element.classList.toggle("dark-mode-page-item");

        });
    });
}

addEvent();