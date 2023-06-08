const fieldsContainer = document.getElementById('fields'); //get all fields elements as fieldsContainer
const fields = Array.from(fieldsContainer.children); //set all fieldsContainer children elements as fields
const selectedProductType = document.getElementById('productType'); //get the select product type field


//map of all product types user can chose
const map = {
    "DVD" : "DVD_attributes",
    "book" : "book_attributes",
    "furniture" : "furniture_attributes"
  };


//add event listener to catch when select product type field changes
selectedProductType.addEventListener('change', (event) => {
  fields.forEach((f) => {
    f.classList.toggle('hidden', f.id !== event.target.options[event.target.selectedIndex].dataset.target); //remove the hidden class from the field whose product type user has chosen
});


localStorage.setItem('selectedOption', event.target.value); //save selected product type in local storage

const selectedProductTypeValue = document.getElementById("productType").value; //set the selected product type value
const specialParamValue = document.getElementById(map[selectedProductTypeValue]).querySelector("input").value; //set the special param input field value


localStorage.setItem("selectedProductTypeValue", selectedProductTypeValue); //save selected product type value in local storage
localStorage.setItem("specialParamValue", specialParamValue); //save special param input field value in local storage 
  
});

// Restore form state on page load
window.onload = function() {
    const selectedOption = localStorage.getItem('selectedOption'); //get the selected product type from local storage
    const selectedProductTypeValue = localStorage.getItem('selectedProductTypeValue'); //get the selected product type value from local storage

  
    if (selectedOption) {
      selectedProductType.value = selectedOption;
      const targetField = document.getElementById(selectedProductType.options[selectedProductType.selectedIndex].dataset.target); //set the special param input field value
      if (targetField) {
        targetField.classList.remove('hidden'); //remove the hidden class from the field whose product type user has chosen
      }
    }

  
    if (selectedProductTypeValue) {
      document.getElementById('productType').value = selectedProductTypeValue; //set the selected product type value
      const selectedFields = document.getElementById(map[selectedProductTypeValue]).querySelectorAll('input'); //get all the special param input field values
      selectedFields.forEach((field) => {
        const fieldName = field.name; //get the input field name for each special param
        const fieldValue = localStorage.getItem(fieldName); //get the input field value for each special param from local storage
        if (fieldValue) {
          field.value = fieldValue; //set the input field value for each special param
        }
      });
    }
  }

//on submit
function submitForm() {

    const selectedOption = localStorage.getItem('selectedOption'); //get the selected product type from local storage
    const selectedProductTypeValue = localStorage.getItem("selectedProductTypeValue"); //get the selected product type value from local storage
  

  // Restore form state

    if (selectedOption) {
        selectedProductType.value = selectedOption;
        const targetField = document.getElementById(selectedProductType.options[selectedProductType.selectedIndex].dataset.target); //set the special param input field value
        if (targetField) {
            targetField.classList.remove('hidden'); //remove the hidden class from the field whose product type user has chosen
        }
    }

    if (selectedProductTypeValue) {
        document.getElementById('productType').value = selectedProductTypeValue; //set the selected product type value
        const selectedFields = document.getElementById(map[selectedProductTypeValue]).querySelectorAll('input'); //get all the special param input field values
        selectedFields.forEach((field) => {
          const fieldName = field.name; //get the input field name for each special param
          const fieldValue = field.value; //get the input field value for each special param
          document.getElementById(fieldName).value = fieldValue; //set the input field value for each special param
        });
      }


    const updatedSelectedOption = selectedProductType.value; //set the updated selected product type
    const updatedSelectedProductTypeValue = document.getElementById('productType').value; //set the updated selected product type value

    const updatedFields = document.getElementById(map[updatedSelectedProductTypeValue]).querySelectorAll('input'); //get all the updated special param input field values 
    updatedFields.forEach((field) => {
        const fieldName = field.name; //set the updated input field name for each special param
        const fieldValue = field.value; //set the updated input field value for each special param
        localStorage.setItem(fieldName, fieldValue); //save all the updated special param input field names and values in local storage 
    });

    localStorage.setItem('selectedOption', updatedSelectedOption); //save the updated selected product type in local storage
    localStorage.setItem('selectedProductTypeValue', updatedSelectedProductTypeValue); //save the updated selected product type value in local storage

    
}


//clear the local storage
function clearAll() {
    localStorage.clear();
}












    
    
    
    
