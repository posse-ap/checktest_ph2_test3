function delete_alert(e){
  if(!window.confirm('本当に削除しますか？')){
      window.alert('キャンセルされました'); 
      return false;
  }
  document.deleteform.submit();
};