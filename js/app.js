function selectProjekt(tr) {
    let projekt_id = tr.getAttribute("data-id");
    window.location.href = "projekt_adatok.php?id=" + projekt_id;
}