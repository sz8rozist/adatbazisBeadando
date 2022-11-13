function selectProjekt(tr) {
    let projekt_id = tr.getAttribute("data-id");
    window.location.href = "projekt_adatok.php?id=" + projekt_id;
}

function editProjektAdat(span){
    let dolgozik_id = span.getAttribute("data-id");
    let edit_projekt = document.getElementById("edit_projekt");
    let edit_munkakor = document.getElementById("edit_munkakor");
    let edit_kezdes_datum = document.getElementById("edit_kezdes_datum");
    let edit_dolgozik_id = document.getElementById("edit_dolgozik_id");
    const xhr = new XMLHttpRequest();
    xhr.open('GET','get.php?id=' + dolgozik_id);
    xhr.send();
    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4 && xhr.status === 200){
            let json = JSON.parse(xhr.responseText);
            console.log(json);
            edit_munkakor.removeAttribute("disabled");
            edit_kezdes_datum.removeAttribute("disabled");
            edit_projekt.removeAttribute("disabled");

            edit_munkakor.value = json.dolgozik_adatok.munkakor;
            edit_kezdes_datum.value = json.dolgozik_adatok.kezdes_datum;
            edit_dolgozik_id.value = json.dolgozik_adatok.id;
            let option = document.createElement("option");
            for (let i = 0; i < json.projektek.length; i++) {
                option.value = json.projektek[i].id;
                option.innerHTML = json.projektek[i].nev;
                if(json.projektek[i].id === json.dolgozik_adatok.projekt_id){
                    option.setAttribute("selected",true);
                }
                edit_projekt.appendChild(option);
            }
        }
    }
}