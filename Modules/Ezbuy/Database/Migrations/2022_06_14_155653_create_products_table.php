<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        $columns = [
            'user'=>'string',
            'status'=>'string',
            'producturl'=>'string',
            'selection'=>'text',
            'variableone'=>'string',
            'variabletwo'=>'string',
            'billid'=>'string',
            'paymentlink'=>'string',
            'paidtime'=>'string',
            'takeprice'=>'int',
            'sellprice'=>'int',
            'categorylink'=>'text',
            'shippingaddress'=>'text',
            'billingaddress'=>'text',
            'tracking'=>'string',
            'comment'=>'string',
        ];
        foreach ($columns as $col => $type) {
            if (!Schema::hasColumn('products', $col)) {
                Schema::table('products', function(Blueprint $table) use ($type,$col)
                {
                    if ($type == 'text') {
                        $table->text($col)->nullable()->comment($col);
                    } else if ($type == 'int') {
                        $table->integer($col)->nullable()->comment($col);
                    } else if ($type == 'timestamp') {
                        $table->timestamp($col)->nullable()->comment($col);
                    } else {
                        $table->string($col, 255)->nullable()->comment($col);
                    }
                });
            }
        }
        // Schema::create('products', function (Blueprint $table) {
        //     $table->id();

        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
