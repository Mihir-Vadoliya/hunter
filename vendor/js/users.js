function setCustomerPayAction() {
if(confirm("Are you sure want to clear payment for these rows?")) {
document.frmUser.action = "update_payment_user.php";
document.frmUser.submit();
}
}
function setActivateAction() {
if(confirm("Are you sure want to activate these rows?")) {
document.frmUser.action = "activate_user.php";
document.frmUser.submit();
}
}
function setDeactivateAction() {
if(confirm("Are you sure want to deactivate these rows?")) {
document.frmUser.action = "deactivate_user.php";
document.frmUser.submit();
}
}