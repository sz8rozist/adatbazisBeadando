function vallalat_detail(tr){
    var cegjegyzekszam = tr.getAttribute("data-id");
    window.location.href = "vallalat_detail.php?cegjegyzekszam="+cegjegyzekszam;
}