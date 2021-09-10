
let id = $("input[name*='emp_task_id']")

$(".btnedit").click( e =>{
    let textvalues = displayData(e);

    let emp_id = $("input[name*='emp_id']");
    let company_id = $("input[name*='company_id']");
    let task_id = $("input[name*='task_id']");
    let completed_date = $("input[name*='completed_date']");
    let amount = $("input[name*='amount']");

    id.val(textvalues[0]);
    emp_id.val(textvalues[1]);
    company_id.val(textvalues[2]);
    task_id.val(textvalues[3]);
    completed_date.val(textvalues[4]);
    amount.val(textvalues[5]);
        

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