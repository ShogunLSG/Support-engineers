
let id = $("input[name*='Emp_id']")
id.attr("readonly","readonly");


$(".btnedit").click( e =>{

    let textvalues = displayData(e);

    let user_id = $("input[name*='id']");
    let company_id = $("input[name*='company_id']");
    let username = $("input[name*='username']");
    let fname = $("input[name*='firstname']");
    let lname = $("input[name*='lastname']");


    user_id.val(textvalues[0]);
    company_id.val(textvalues[1]);
    username.val(textvalues[2]);
    fname.val(textvalues[3]);
    lname.val(textvalues[4]);



});


function displayData(e) {
    let id = 0;
    const td = $("#tbody tr td");
    let textvalues = [];

    for (const value of td){
        if(value.dataset.id == e.target.dataset.id){
           textvalues[id++] = value.textContent;
        }
    }
    return textvalues;

}