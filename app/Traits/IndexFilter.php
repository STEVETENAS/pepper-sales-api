<?php

namespace App\Traits;

use App\Http\Controllers\Controller;

class IndexFilter extends Controller
{
    public static function filters($model, $request)
    {
        $output = $model->latest()->get();
        foreach ($model->getFillable() as $attribute) {
            if ($request->query($attribute))
            { $output = $model->where($attribute, 'like', '%' . $request->input($attribute) . '%')->get(); }
        }

        if ($request->query('id'))
        { $output = $model->where('id', $request->input('id'))->get(); }

        if ($request->query('size'))
        { return $output->latest()->paginate($request->input('size')); }
        return $output;
    }
}
