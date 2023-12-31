<?php 
class Subscription extends Eloquent {
	//use SoftDeletingTrait;
	
	protected $table = 'subscriptions';
	protected $primaryKey = 'subscription_id';
	/*protected $softDelete = true;
	protected $dates = ['deleted_at'];*/
}