function deleteBookRedirect (bookID) {
    if (!confirm("Будет удалена вся информация, связанная с этой записью! Продолжить?")) {
        return;
    }
    document.getElementById("deleting_book_id_input").value = bookID;
    document.getElementById("deleting_book_form").submit();
}