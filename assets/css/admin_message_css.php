<style>
.message_main_container {
  max-width: 550px;
  width: 100%;
  margin: 10px 0;
  margin-left: auto;
  margin-right: auto;
  box-sizing: border-box;
}
.message_main_container .message_div {
  min-height: 300px;
}
.message_view {
  margin-bottom: 30px;
  margin-left: 18px;
  margin-right: 18px;
}
.view_inner {
  position: relative;
}
.view_inner::after {
  content: "";
  left: -9px;
  position: absolute;
  border-width: 12px;
  border-style: solid;
  border-color: transparent transparent transparent #ffffff;
  height: auto;
  width: auto;
  transform: rotate(90deg);
  top: 0;
  background: transparent;
  z-index: -1;
}
.admin .view_inner::after {
  left: auto;
  right: -9px;
}
.message_view p {
  margin: 0 !important;
  background-color: #fff;
  width: max-content;
  max-width: 300px;
  white-space: normal;
  color: #262626;
  font-size: 13.6px;
  line-height: 19px;
  padding: 7px 7px 6px 9px;

  background-color: #fff;
  border-radius: 7.5px;
  border-top-right-radius: 0;
  box-shadow: 0 1px 0.5px rgba(0, 0, 0, 0.15);
  min-width: 80px;
}
.message_view.user p {
  border-top-right-radius: 7.5px;
  border-top-left-radius: 0;
  text-align: left;
}
.user {
  display: flex;
}
.admin {
  text-align: left;
  margin-left: auto !important;
  display: flex;
  justify-content: end;
  width: max-content;
}
.admin_mesage_send_cont {
  width: 100%;
  position: relative;
}
.admin_mesage_send_cont input {
  box-sizing: border-box;
  width: 100%;
  border: none;
  outline: none;
  height: 50px;
  border-radius: 30px;
  padding: 8px 20px;
  padding-right: 60px;
  background-color: #fff;
  border: 1px solid rgba(0, 0, 0, 0.1);
}
#send_message_by_admin_btn {
  position: absolute;
  right: 10px;
  top: 50%;
  z-index: 999;
  cursor: pointer;
  background: transparent;
  border: none;
  outline: none;
  box-shadow: none;
  transform: translatey(-50%);
  padding: 0;
  background: rgba(0, 0, 0, 0.1);
  border-radius: 50%;
  height: 33px;
  width: 33px;
  min-width: 33px;
  display: flex;
  align-items: center;
  justify-content: center;
}
#send_message_by_admin_btn img {
  max-width: 22px;
  object-fit: contain;
}
</style>