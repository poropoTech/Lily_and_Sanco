/**
 * @return {boolean}
 */
window.ResponseAutosubmit = function(responseModal) {

    if($(responseModal).find('.response-new-modal-autosubmit').length)
    {
        $('#response-new-modal-form').trigger('submit');
        return true;
    }
    return false;
};
