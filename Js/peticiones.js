const v_especialidad = document.getElementById('especialidad')
v_especialidad.addEventListener("change", getMedicos)

const cbxMedico = document.getElementById('medico')


function fetchAndSetData(url,formData, targetElement){
    return fetch(url,{

        method: 'POST',
        body: formData,
        mode: 'cors'
    })
    .then(response => response.json())
    .then(data =>{
          targetElement.innerHTML = data 
    } ) 
    
.catch(err => console.log(err))
}

function getMedicos(){
    let especialidad  = v_especialidad.value 
    let url = '../administrador/get_medico.php'
    let formData = new FormData()
    formData.append('id_especialidad',especialidad)

    fetchAndSetData(url,formData, cbxMedico)
}