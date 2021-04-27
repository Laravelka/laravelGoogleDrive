<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'contacts',
		'file_name',
		'contract_end',
		'contract_conclusion',
		'contract_termination',

	];

	public function user() {
		return $this->belongsTo('App\Models\User');
	}
}
