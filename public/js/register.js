const form = document.getElementById('parent-register');
const studentNo = document.getElementById("student-no");

form.addEventListener('submit', e => {
    e.preventDefault();
    alert('nn=o')
});


studentNo.addEventListener("keyup", function(e){
    console.log(studentNo.value)
});
