<link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
  rel="stylesheet"
/>
<style>
  .dt-length .dt-input {
    min-width: 50px;
    margin-right: 5px;
  }
  table,
  th,
  td {
    border: 1px solid black;
    border-collapse: collapse;
  }
  .full_width {
    width: 100% !important;
    box-sizing: border-box;
  }
  .pe_20 {
    padding-right: 20px;
  }
  table.dataTable th.dt-type-date,
  table.dataTable th.dt-type-numeric,
  table.dataTable td.dt-type-date {
    text-align: start !important;
  }
  table.dataTable th,
  table.dataTable th.dt-type-date,
  table.dataTable th.dt-type-numeric,
  table.dataTable td.dt-type-numeric {
    text-align: center !important;
  }
  table.dataTable th {
    color: #fff !important;
    background-color: transparent;
    background-image: linear-gradient(90deg, #313fa0 50%, #313fa0 50%);
  }
  .btn.btn-primary,
  table.dataTable .btn.btn-primary {
    background-color: #313fa0 !important;
    border: solid 1px #313fa0 !important;
    display: inline-block !important;
    margin-right: 10px !important;
    color: #fff !important;
    font-size: 16px !important;
    font-weight: 400 !important;
  }
  #report_content{
    min-height: 220px;
  }
  #report_title{
    height: 45px;
  }
  #report_content,
  #report_title{
    border: 1px solid #8c8f94;
  }
  #report_content:focus,
  #report_title:focus{
    box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25);
    
  }
  .removefile{
    box-shadow: none;
    border: 1px solid #8c8f94;
    border-radius: 50%;
    height: 35px;
    width: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 10px;
  }
  .file_item {
    display: flex;
    width: max-content;
    max-width: 100%;
}
.file_item:not(:last-child){
  margin-bottom: 15px;
}

#financial_document_admin th,
#financial_document_admin td
{
white-space: nowrap;
  /*   max-width: 200px; */
}
#financial_document_admin_wrapper .dt-layout-cell  {
  overflow: auto;
}
</style>
