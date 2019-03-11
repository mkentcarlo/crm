<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <a href="#">
                        <i class="fa fa-times"></i>
                    </a>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    <span class="glyphicon glyphicon-exclamation-sign" style="color:#D91E18;"></span></h4>
            </div>
            <div class="modal-body">
                <div class="modal-loader" hidden>
                    <img src="{{ asset('images/ajax-loader.gif') }}" class="center-block"/>
                    <div>&nbsp;</div>
                </div>
                <div class="modal-message" hidden></div>
                <div id="confirm_msg">Are you sure you want to delete this product?</div>
            </div>
            <div class="modal-footer">
                <div id="del_btn_holder">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="yesBtn">Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>