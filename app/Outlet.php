<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $fillable = [
        'name', 'address', 'pemilik', 'kontak_pemilik',
        'tipe_kos', 'harga_sewa', 'fasilitas', 'sisa_kamar',
        'latitude', 'longitude',
        'name_foto_kos', 'mime_foto_kos','file_foto_kos',
        'name_foto_kamar', 'mime_foto_kamar','file_foto_kamar',
        'creator_id',
    ];

    public $appends = [
        'coordinate', 'map_popup_content',
    ];

    public function getNameLinkAttribute()
    {
        $title = __('app.show_detail_title',
            ['name' => $this->name, 'type' => __('outlet.outlet'),]
        );
        $link = '<a href="'.route('outlets.show', $this).'"';
        $link .= ' title="'.$title.'">';
        $link .= $this->name;
        $link .= '</a>';

        return $link;
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function getCoordinateAttribute()
    {
        if ($this->latitude && $this->longitude) {
            return $this->latitude.', '.$this->longitude;
        }
    }

    public function getMapPopupContentAttribute()
    {
        $mapPopupContent = '';
        $mapPopupContent .= '<div class="my-2" style="text-align:center;"><br><img src="data:image/jpeg;base64,'.$this->file_foto_kos.'" height="140" class="rounded"/></div>';
        $mapPopupContent .= '<div class="my-2"><strong>'.__('outlet.name').':</strong><br>'.$this->name_link.'</div>';
        $mapPopupContent .= '<div class="my-2"><strong>'.__('outlet.coordinate').':</strong><br>'.$this->address.'</div>';

        return $mapPopupContent;
    }
}
