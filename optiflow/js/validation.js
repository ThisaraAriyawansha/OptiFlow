document.getElementById("customerForm").onsubmit = function(event) {
    event.preventDefault(); 

    if (!validateCustomerForm()) {
        return; 
    }

    let formData = new FormData(this); 

    fetch(this.action, {
        method: this.method,
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            swal("Success!", data.message, "success");
            document.getElementById("customerForm").reset();
        } else {
            swal("Validation Error", data.errors.join("\n"), "error");
        }
    })
    .catch(error => {
        swal("Error!", "An error occurred: " + error.message, "error");
    });
};

document.getElementById("itemForm").onsubmit = function(event) {
    event.preventDefault(); 

    if (!validateItemForm()) {
        return; 
    }

    let formData = new FormData(this);

    fetch(this.action, {
        method: this.method,
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            swal("Success!", data.message, "success");
            document.getElementById("itemForm").reset();
        } else {
            swal("Validation Error", data.errors.join("\n"), "error");
        }
    })
    .catch(error => {
        swal("Error!", "An error occurred: " + error.message, "error");
    });
};

function validateCustomerForm() {
    let title = document.getElementById("title").value;
    let firstName = document.getElementById("firstName").value.trim();
    let lastName = document.getElementById("lastName").value.trim();
    let contactNumber = document.getElementById("contactNumber").value.trim();
    let district = document.getElementById("district").value;

    if (title === "") {
        swal("Validation Error", "Please select a title.", "error");
        return false;
    }
    if (firstName === "" || lastName === "") {
        swal("Validation Error", "Please enter your full name.", "error");
        return false;
    }
    if (!/^[0-9]{10}$/.test(contactNumber)) {
        swal("Validation Error", "Please enter a valid 10-digit contact number.", "error");
        return false;
    }
    if (district === "") {
        swal("Validation Error", "Please select a district.", "error");
        return false;
    }
    return true;
}

function validateItemForm() {
    let itemCode = document.querySelector("#itemForm [name='item_code']").value.trim();
    let itemName = document.querySelector("#itemForm [name='item_name']").value.trim();
    let category = document.querySelector("#itemForm [name='category']").value;
    let subCategory = document.querySelector("#itemForm [name='sub_category']").value;
    let quantity = document.querySelector("#itemForm [name='quantity']").value;
    let unitPrice = document.querySelector("#itemForm [name='unit_price']").value;

    if (itemCode === "" || itemName === "") {
        swal("Validation Error", "Please enter both item code and item name.", "error");
        return false;
    }
    if (category === "") {
        swal("Validation Error", "Please select an item category.", "error");
        return false;
    }
    if (subCategory === "") {
        swal("Validation Error", "Please select an item sub-category.", "error");
        return false;
    }
    if (quantity === "" || quantity <= 0) {
        swal("Validation Error", "Please enter a valid quantity.", "error");
        return false;
    }
    if (unitPrice === "" || unitPrice <= 0) {
        swal("Validation Error", "Please enter a valid unit price.", "error");
        return false;
    }
    return true;
}
