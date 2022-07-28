const secondArea = document.querySelector(".second_area");
const header = document.querySelector(".inside_text");
const button = document.querySelector(".docs_btn");
const input = document.querySelector(".doc_input");
// let file = null;
button.onclick = () => {
    input.click(); //button ko click yinn input ko click function call pay tar;
};

input.addEventListener("change", function () {
    file = this.files[0];
    console.log(file);
    showFile();//Callback function
    secondArea.classList.add("active");

});
//If user Drag File Over DrogAreadashboard
secondArea.addEventListener("dragover", (event) => {
    event.preventDefault(); //Peeventing from default behaviour
    console.log("over the secondArea file");
    secondArea.classList.add("active");
    header.textContent = "Release to upload file";
});

//If user leave dragged file from DropArea
secondArea.addEventListener("dragleave", () => {
    console.log("file the secondArea file");
    secondArea.classList.remove("active");
    header.textContent = "Drag & Drop to upload file";
});

// ID user drop file on dropArea
secondArea.addEventListener("drop", (event) => {
    event.preventDefault();
    console.log("file is drop On second area");
    file = event.dataTransfer.files[0];
    console.log('secondArea ', file);
    showFile();//Callback function
});

function showFile() {
    // console.log(file);
    let fileType = file.type;
    // console.log(fileType);
    let validExtensions = ["image/jpeg", "image/jpg", "image/png"];
    let include = validExtensions.includes(fileType);
    // console.log(include);
    if (include) {
        //
        let fileReader = new FileReader();
        fileReader.onload = () => {
            let fileURL = fileReader.result;
            console.log(fileURL);
            let imageText = `
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <img src="${fileURL}" alt=""></img>
                    <button class="btn btn-primary docs_btn">Browse File</button>
            `;
            secondArea.innerHTML = imageText;
        };
        fileReader.readAsDataURL(file);
    } else {
        let fileReader = new FileReader();
        fileReader.onload = () => {
            let fileURL = fileReader.result;
            console.log(fileURL);
            let imageText = `
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <h6 class="inside_text">${file.name}</h6>
                            <button class="btn btn-primary docs_btn">Browse File</button>
                        `;
            secondArea.innerHTML = imageText;
        };
        fileReader.readAsDataURL(file);
    }
}
