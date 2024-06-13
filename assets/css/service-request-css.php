<?php

?>
<style>
.enc-white {
  color: whitesmoke !important;
}
:root {
  --white-color: #ffffff;
  --primary-color: #91d3ee;
  --border-color: #8c8f94;
  --text-color: #3c434a;
  --bg-secondary-color: #c3e1ff;
}
input[type="radio"],
input[type="checkbox"] {
  height: 19px;
  opacity: 100;
  width: 20px;
  display: inline !important;
  -webkit-appearance: checkbox !important;
}
.total__price {
  display: flex;
  justify-content: space-between;
  padding: 13px 20px;
  border-radius: 6px;
  background-color: var(--bg-secondary-color);
  font-size: 16px;
  font-weight: 600;
  color: #0f668a;
  margin: 25px 0;
}
.total__price span {
  font-size: 16px;
  font-weight: 600;
  color: #0f668a;
}
input {
  border: 1px solid var(--primary-color);
}
.d-flex-center {
  display: flex;
  align-items: center;
}
.d-flex {
  display: flex;
}
.row_d {
  display: flex;
  flex-wrap: wrap;
}
form {
  font-size: 15px;
  margin-top: 25px;
  padding-top: 30px;
  border-top: 1px solid var(--border-color);
  max-width: 900px;
}
.titel_col {
  width: calc(30% - 25px);
  min-width: 215px;
  margin-right: 25px;
}
.titel_col label {
  font-weight: 500;
  font-size: 18px;
}
.right_col {
  width: 70%;
}
form textarea {
  border: 2px solid var(--primary-color);
  resize: none;
  border-radius: 6px;
  min-height: 130px;
}
form .row_d {
  margin-bottom: 30px;
}
form .services_row {
  padding-top: 30px;
  border-top: 1px solid var(--border-color);
}
#get_customized_selection_undone,
#get_customized_selection,
#add_new_fixed_service,
form #addFile {
  border: 2px solid var(--primary-color);
  color: var(--text-color);
  padding: 7px 15px;
  border-radius: 6px;
  font-size: 15px;
  font-weight: 500;
}
form #files .file_item:first-child {
  margin-top: 20px;
}
form .add__file__container input,
form .add__file__container input[type="file"] {
  border: none;
}
.add__file__container .removefile {
  background-color: rgb(255, 0, 0);
  border-radius: 50%;
  height: 16px;
  width: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  border: none;
  outline: none;
  color: #fff;
  font-size: 10px;
  font-weight: 500;
  padding: 0;
  margin-left: 5px;
  cursor: pointer;
}
.add__file__container .file_item {
  display: flex;
  align-items: center;
}
.payment_method_container .item:not(:last-child),
.product__container .product__item:not(:last-child) {
  margin-bottom: 12px;
}
.product__container .product__item label {
  justify-content: space-between;
  width: 100%;
}
.payment_method_container .item {
}
.services_row input,
.payment_method_container input {
  margin-top: 1px;
  margin-right: 16px;
}
.services_row input:focus,
.payment_method_container input:focus {
  border: none;
  outline: none;
  box-shadow: none;
}
.submit_btn {
  text-align: right;
}
.submit_btn .buttons {
  padding: 12px 25px;
  background: var(--text-color);
  color: var(--white-color);
  border-radius: 6px;
  cursor: pointer;
  border: 2px solid var(--primary-color);
}
.person_number_col input {
  max-width: 100px;
}
.right_total_price .ElementsApp .InputElement.is-invalid {
  color: #3c434a !important;
}
.right_total_price .ElementsApp .InputElement.is-invalid {
  color: #eb1c26 !important;
}
.right_total_price .ElementsApp.is-invalid .Icon-fill {
  fill: #eb1c26 !important;
}
.right_total_price .ElementsApp .Icon-fill {
  fill: #3c434a !important;
}
.right_total_price .InputContainer input::placeholder {
  color: #3c434a !important;
  opacity: 1;
}
.right_total_price .InputContainer input::-ms-input-placeholder {
  color: #3c434a !important;
}
/* form elements */
label {
  display: block;
}
input {
  font: normal 1em Verdana, sans-serif;
}
select {
  padding: 2px;
  border: 1px solid #eee;
  font: normal 1em Verdana, sans-serif;
  color: #777;
  width: 100%;
}
input[type="radio"],
input[type="checkbox"] {
  height: 16px;
  opacity: 100;
  width: 16px;
  display: inline !important;
  -webkit-appearance: checkbox !important;
}
#customized_section_service .product__item,
#fixed_section_service .product__item {
  border: "1px solid #b3b7b9";
  border-radius: 6px;
  padding: 5px 13px;
  margin-bottom: 12px;
  min-height: 30px;
  background-color: var(--white-color);
}
#fixed_section_service .product__item .removeservice {
  margin-left: 15px;
  background-color: rgb(255, 0, 0);
  border-radius: 50%;
  height: 16px;
  width: 16px;
  min-width: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  border: none;
  outline: none;
  color: #fff;
  font-size: 10px;
  font-weight: 500;
  padding: 0;
}
#fixed_section_service .product__item input[type="number"] {
  max-width: 71px;
  margin: 0;
}
.select2-container .select2-selection--single {
  min-height: 32px;
}
#fixed_section_service .product__item input:focus {
  border: 1px solid var(--primary-color);
}
button {
  cursor: pointer;
}
#customized_section_service[style*="display: none;"],
#fixed_section_service[style*="display: none;"] {
  height: 0;
  opacity: 0;
  transition: opacity 0.7s ease, height 0.7s ease;
}
#customized_section_service[style*="display: block;"],
#fixed_section_service[style*="display: block;"] {
  height: auto;
  opacity: 1;
  transition: opacity 0.7s ease, height 0.7s ease;
}
#get_customized_selection_undone,
#get_customized_selection {
  min-width: 207px;
}
.p_title_price {
  margin-bottom: 0 !important;
  width: 100%;
  justify-content: space-between;
}
.d-flex-center {
  display: flex !important;
  align-items: center;
}
.add__file__container .file_item:not(:last-child),
.product__item:not(:last-child) {
  margin-bottom: 5px;
}
.p_title_price .title {
  margin-right: 15px;
}
.product__item input[type="checkbox"] {
  -webkit-appearance: none !important;
  -moz-appearance: none !important;
  position: relative;
  top: 2px;
  display: inline-block;
  margin: 0;
  width: 1.5rem;
  min-width: 1.5rem;
  height: 1.5rem;
  background: #fff;
  border-radius: 0;
  border: 0.1rem solid #dcd7ca !important;
  box-shadow: none !important;
  cursor: pointer !important;
  margin-bottom: 3px;
}
.product__item input[type="checkbox"]:checked::before {
  content: url("data:image/svg+xml;utf8,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20viewBox%3D%270%200%2020%2020%27%3E%3Cpath%20d%3D%27M14.83%204.89l1.34.94-5.81%208.38H9.02L5.78%209.67l1.34-1.25%202.57%202.4z%27%20fill%3D%27%23000000%27%2F%3E%3C%2Fsvg%3E");
  position: absolute;
  display: inline-block;
  margin: -0.1875rem 0 0 -0.25rem;
  height: 1.75rem;
  width: 1.75rem;
}
.request_service_form #description {
  border: 0.1rem solid #dcd7ca !important;
  border-radius: 0 !important;
}
.request_service_form #description:focus {
  border-color: currentColor !important;
}
.request_service_form button#addFile {
  color: #fff;
  background-color: #7b7979;
  border-radius: 0;
  font-weight: 400;
  padding: 12px 24px;
  font-size: 14px;
  transition: all 0.5s ease-in-out 0s;
  border: none !important;
  text-decoration: none !important;
}
.submit_btn .buttons {
  border-radius: 0;
  border: none;
  transition: all 0.5s ease-in-out 0s;
  color: #fff;
  background-color: #7b7979;
}
.submit_btn .buttons:hover,
.request_service_form button#addFile:hover {
  background-color: #f73c19;
  color: #fff;
}
.add__file__container .removefile {
  background-color: #f73c19 !important;
}
.add_file_cont {
  /* margin-top: 25px; */
}
form .add__file__container input,
form .add__file__container input[type="file"] {
  max-width: calc(100% - 25px);
}
.textarea_heading {
  margin: 25px 0;
}
.request_service_form *:not(.total__price *, #description) {
  color: #ffffff !important;
  text-decoration: none !important;
}
.add__file__container .removefile {
  min-width: 16px;
}
.request_service_form .titel_col {
  width: calc(40% - 25px);
  min-width: 245px;
}
.request_service_form .right_col {
  width: 60%;
}
.payment_method_container {
  margin-bottom: 15px;
}
.payment_method_container .item:not(:last-child),
.product__container .product__item:not(:last-child) {
  margin-bottom: 5px;
}
.request_service_form .total__price {
  border-radius: 0;
  background-color: #fff;
  color: #1d1d1ddb;
}
.request_service_form .total__price * {
  color: #1d1d1ddb;
}

@media only screen and (max-width: 1100px) {
  form {
    max-width: 700px;
  }
  .right_col {
    width: 60%;
  }
  .titel_col {
    width: calc(40% - 25px);
    min-width: 150px;
  }
}
@media only screen and (max-width: 520px) {
  .right_col {
    width: 100%;
  }
  .titel_col {
    margin-right: 0;
    margin-bottom: 20px;
    width: 100%;
    min-width: 150px;
  }
  .request_service_form .titel_col {
    width: 100%;
    min-width: 100%;
    margin-right: 0;
  }
  .request_service_form .right_col {
    width: 100%;
  }
}

</style>
