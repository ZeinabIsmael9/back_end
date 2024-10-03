<?php

/**   Interface Segregation Principle  */
interface Printer
{
    public function print();
}
interface Scanner
{
    public function scan();
}
class AllinOnePrinter implements Printer, Scanner
{
    public function print()
    {
        echo "All In one Printer";
    }
    public function scan()
    {
        echo "All In one Printer can scan";
    }
}

class Scaning implements Scanner
{
    public function scan()
    {
        echo "Scanner";
    }
}

class Printing implements Printer
{
    public function print()
    {
        echo "Printer";
    }
}

