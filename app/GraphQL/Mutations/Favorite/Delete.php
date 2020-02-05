<?php

namespace App\GraphQL\Mutations\UserCenter;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Validator;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Create
{
    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        //查询用户是否存在
        $data = $args['input'];
        $this->validate($data);
        $user = auth()->user();
        $user->update($data);
        return [
            'status'=> 200,
            'message'=>'更新成功!',
        ];
    }
    public function validate($data){
        $rules = [
            'name'=>['required'],
            'avatar_url'=>['required','url'],
            'role'=>['required'],
        ];
        $messages = [
            'name.required'=>'姓名不能为空',
            'avatar_url.required'=>'头像不能为空',
            'avatar_url.url'=>'头像地址格式不正确',
            'role.required'=>'身份不能为空',
        ];
        $validate = Validator::make($data,$rules,$messages);
        if ($validate->fails()) {
            throw new \InvalidArgumentException($validate->messages()->first());
        }
        return true;
    }
}
