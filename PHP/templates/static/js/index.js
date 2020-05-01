M.Collapsible.init(document.querySelectorAll('.collapsible'), null);
$.ajax({
    url: "/api/questions/get",
    method: "GET"
}).done(res => {
    let resObj = JSON.parse(res);
    resObj.forEach(elem => {
        let li = document.createElement("li");

        li.innerText = elem.Quiz;
        li.className = "white-text";

        document.getElementById("recent").appendChild(li);
    });
});