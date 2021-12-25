<?php

require __DIR__ . '/vendor/autoload.php';

use APIToken\Token;

echo(Token::generate(10));

echo(Token::verify('eyJpcCI6bnVsbCwic2VlZCI6ImJvdnMxNTAiLCJpZCI6MTB9', 10));