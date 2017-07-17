function deleteAuthorRedirect (authorID) {
    if (!confirm("Будет удалена вся информация, связанная с этой записью! Продолжить?")) {
        return;
    }
    document.getElementById("deleting_author_id_input").value = authorID;
    document.getElementById("deleting_author_form").submit();
}