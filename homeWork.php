<?php
// объясняли на уроке. Выведет 1234, потому что переменная statik принадлежит классу а не объектам.
/* class A {
public function foo() {
static $x = 0;
echo ++$x;
}
}
$a1 = new A();
$a2 = new A();
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo();

echo "</br>";
 */



/* class A {
public function foo() {
static $x = 0;
echo ++$x;
}
}
class B extends A {
}
$a1 = new A();
$b1 = new B();
$a1->foo(); // 1
$b1->foo(); // 1 - потому что это другой класс на основе первого
$a1->foo(); // 2 - потому что переменная x -static
$b1->foo(); // 2 - потому что этот класс сделан на осонове первого и работает как первый */

//  тут будет такой же результат поскольку у калсов нет конструктора и скобки необязателны.  
class A
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A
{
}
$a1 = new A;
$b1 = new B;
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();
