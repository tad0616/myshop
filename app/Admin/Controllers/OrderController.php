<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Order;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class OrderController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('訂單管理')
            ->description('管理所有訂單')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order);

        $grid->id('編號');
        $grid->user_id('使用者編號');
        $grid->address('寄送地址');
        $grid->total('總計');
        $grid->closed('是否關閉');
        $grid->created_at('建立時間');
        $grid->updated_at('更新時間');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Order::findOrFail($id));

        $show->id('編號');
        $show->user_id('使用者編號');
        $show->address('寄送地址');
        $show->total('總計');
        $show->closed('是否關閉');
        $show->created_at('建立時間');
        $show->updated_at('更新時間');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Order);

        $form->number('user_id', '使用者編號');
        $form->textarea('address', '寄送地址');
        $form->number('total', '總計');
        $form->switch('closed', '是否關閉');

        return $form;
    }
}
