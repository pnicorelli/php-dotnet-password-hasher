<?php
// declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use DotNetPasswordHasher\DotNetPasswordHasher;

final class DotNetPasswordHasherTest extends TestCase
{

  private $bestPassword = 'CorrectHorseBatteryStaple';
  private $validHash    = 'ACPPWQepe6xsGKZC2DQQjll0fI0tpDgVjXKtIqApLaHY/6ZNJDhJ8z1og8hUx7IPSQ==';
  private $invalidHash  = 'XCPPWXepe6xsGKZC4DQQjll0fI0tpDgVjXKtIqApLaHY/55NJDhJ8z1og8hUx7IPSE==';

  public function testVerifyShoudBeTrueOnMatch(): void
  {
    $this->assertEquals(
      DotNetPasswordHasher::verify($this->bestPassword, $this->validHash, "sha1"),
      true
    );
  }

  public function testVerifyShoudBeFalseOnMismatch(): void
  {
    $this->assertEquals(
      DotNetPasswordHasher::verify($this->bestPassword, $this->invalidHash, "sha1"),
      false
    );
  }

  public function testHashShoudWorks(): void
  {
    $hash = DotNetPasswordHasher::hash($this->bestPassword, "sha1");
    $this->assertEquals(
      DotNetPasswordHasher::verify($this->bestPassword, $hash, "sha1"),
      true
    );
    $differentPassword = "RandomPassword";
    $differentHash = DotNetPasswordHasher::hash($differentPassword, "sha1");
    $this->assertEquals(
      DotNetPasswordHasher::verify($differentPassword, $hash, "sha1"),
      false
    );
    $this->assertEquals(
      DotNetPasswordHasher::verify($differentPassword, $differentHash, "sha1"),
      true
    );
  }

  public function testHashShoudWorksWithDifferentAlgo(): void
  {
    $hash = DotNetPasswordHasher::hash($this->bestPassword, "sha256");
    $this->assertEquals(
      DotNetPasswordHasher::verify($this->bestPassword, $hash, "sha256"),
      true
    );

    $differentHash = DotNetPasswordHasher::hash($this->bestPassword, "sha1");
    $this->assertEquals(
      DotNetPasswordHasher::verify($this->bestPassword, $differentHash, "sha256"),
      false
    );
  }
}
