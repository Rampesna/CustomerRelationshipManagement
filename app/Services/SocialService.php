<?php

namespace App\Services;

use App\Models\Social;
use Illuminate\Http\Request;

class SocialService
{
    private $social;

    /**
     * @return Social
     */
    public function getSocial(): Social
    {
        return $this->social;
    }

    /**
     * @param Social $social
     */
    public function setSocial(Social $social): void
    {
        $this->social = $social;
    }

    public function save(Request $request)
    {
        $this->social->relation_type = $request->relation_type;
        $this->social->relation_id = $request->relation_id;
        $this->social->link = $request->link;
        $this->social->created_by = $request->id ? $this->social->created_by : $request->auth_user_id;
        $this->social->last_updated_by = $request->auth_user_id;
        $this->social->save();

        return $this->social;
    }
}
