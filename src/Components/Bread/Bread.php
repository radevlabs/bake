<?php


namespace Radevlabs\Bake\Components\Bread;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Radevlabs\Bake\Bake;

abstract class Bread extends Component
{
    /**
     * @var string
     */
    protected $key = 'id';

    /**
     * fields that are not shown
     *
     * @var array
     */
    protected $hiddenFields = [
        'id',
        'deleted_at',
        'updated_at',
        'email_verified_at',
        'password',
        'remember_token'
    ];

    /**
     * shown fields
     *
     * @var
     */
    public $visibleFields;

    /**
     * route of this page
     *
     * @var
     */
    protected $route;

    /**
     * this will authorize action you've made depands
     * on `require` column in permission table
     *
     * @param $require
     * @param $requiredData
     * @param string $message
     * @param string $type
     * @return bool
     * @throws \ErrorException
     */
    protected function authorize($require, $requiredData, $message = 'success', $type = 'success')
    {
        if (!empty($require)){
            if ($require == Bake::REQUIRE_PASSWORD){
                if (empty($requiredData)){
                    $this->emit('bake-alert', [
                        'title' => 'Warning',
                        'type' => 'warning',
                        'message' => baketranslate('Fill your password', 'en')
                    ]);

                    return false;
                } elseif (!Hash::check($requiredData, Auth::user()->password)){
                    $this->emit('bake-alert', [
                        'title' => 'Wrong',
                        'type' => 'danger',
                        'message' => baketranslate('Your password is wrong', 'en')
                    ]);

                    return false;
                }

                return true;
            }
        }

        $this->emit('bake-alert', [
            'title' => 'Success',
            'type' => $type,
            'message' => baketranslate($message, 'en')
        ]);

        return true;
    }

    protected function fields() : array
    {
        return [];
    }

    protected function title()
    {
        $permission = bake()->permission($this->route);
        $title = <<<blade
            <i class="fa $permission->icon"></i> $permission->name
        blade;


        return $title;
    }

    protected function resource()
    {
        return DB::table('');
    }

    protected function aliases() : array
    {
        $aliases = [];

        /**
         * default alias is to remove
         * '_' from field name and
         * translate it
         */
        foreach ($this->fields() as $field){
            $alias = str_replace('_', ' ', $field);
            $alias = baketranslate($alias, 'en', null, 'ucwords');
            $aliases[$field] = $alias;
        }

        return $aliases;
    }

    protected function casts() : array
    {
        $imageFunction = function ($data) {
            $explodes = explode('/', $data);
            $alt = end($explodes);
            $data = asset($data);
            return <<<blade
                <a href="$data" data-title="$alt">
                    <img src="$data" class="img-fluid mb-2" alt="$alt" style="max-width: 30px;max-height: 30px">
                </a>
            blade;
        };

        return [
            'email' => function ($data) {
                return '<a href="mailto:'.$data.'">'.$data.'</a>';
            }, 'created_at' => 'readable_datetime',
            'image' => $imageFunction,
            'avatar' => $imageFunction
        ];
    }

    public function mount()
    {
        $this->visibleFields = collect($this->fields())
            ->diff($this->hiddenFields)
            ->toArray();
    }

    protected function data()
    {
        $casts = $this->casts();
        collect($this->visibleFields)
            ->each(function ($field) use (&$casts) {
                if (!array_key_exists($field, $casts)){
                    $casts[$field] = function ($data){
                        return $data;
                    };
                }
            });

        return [
            'title' => $this->title(),
            'aliases' => $this->aliases(),
            'casts' => $casts
        ];
    }
}
