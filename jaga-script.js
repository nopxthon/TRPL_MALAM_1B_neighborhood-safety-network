//untuk laporan
function cek_data(){
    if(document.getElementById('deskripsi').value == ''){
        alert('Deskripsi Harus Diisi');
        document.getElementById('deskripsi').focus();
        return false;
    }
    if(document.getElementById('lokasi').value ==''){
        alert('Lokasi Harus Diisi');
        document.getElementById('lokasi').focus();
        return false;
    }
    document.getElementById('form1').submit();
}

//nav link on scroll
let section=document.querySelectorAll('section')
let navLink=document.querySelectorAll('header nav a')
window.onscroll=()=>{
    section.forEach(sec=>{
        let top=window.scrollY;
        let offset=sec.offsetTop-150;
        let height=sec.offsetHeight;
        let id=sec.getAttribute('id')
        if (top>offset && top<offset + height){
            navLink.forEach(links=>{
                links.classList.remove('active')
                document.querySelector('header nav a[href*='+id+']').classList.add('active')
            })
        }
    })
}