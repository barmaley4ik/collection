<?php
namespace App\Http\Traits;


trait MsgTrait {

	public function msgInsert() {

        return __('admin.general.alert-success-create');
    }
	
	public function msgUpdate() {

        return __('admin.general.alert-success-update');
    }

	public function msgDelete() {

        return __('admin.general.alert-success-delete');
    }
	
	public function msgCantDelete() {

        return __('admin.general.alert-success-cant-delete');
    }

	public function msgError() {

        return __('admin.general.alert-error');
    }
	
	public function msgReplicate() {

        return __('admin.general.alert-replicate');
    }
	
	public function msgCantDeleteOrder() {

        return __('admin.general.alert-deleteorder');
    }

	public function msgCantEditOrder() {

        return __('admin.general.alert-editorder');
    }
}