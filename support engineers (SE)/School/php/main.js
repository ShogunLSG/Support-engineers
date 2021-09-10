let id = $("input[name*='task_id']")
id.attr("readonly","readonly");


$(".btnedit").click( e =>{

    let textvalues = displayData(e);

    let task_id = $("input[name*='task_id']");
    let company_id = $("input[name*='company_id']");
    let school_id = $("input[name*='school_id']");
    let task_description = $("input[name*='task_description']");
	
    task_id.val(textvalues[0]);
    company_id.val(textvalues[1]);
    school_id.val(textvalues[2]);
    task_description.val(textvalues[3]);



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