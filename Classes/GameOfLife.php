<?php
/**
 * Description of GameOfLife
 *
 * @author Niels van Reijmersdal
 */
class GameOfLife {

	public $field = array();
	public $field_temp = array();
  public $maxx, $maxy;

	public function createField($x, $y, $random = 0) {
    $this->maxx = $x;
    $this->maxy = $y;
    
		for($i=0;$i<$x;$i++){
			for($j=0;$j<$y;$j++){
        if($random) {
          $this->field[$i][$j] = mt_rand(0,1);         
        } else {
          $this->field[$i][$j] = 0;
        }
			}
		}
  }
  
  public function getMaxX() {
    if(!$this->maxx) {
      $this->maxx = sizeof($this->field);
    }
    return $this->maxx;
  }

  public function getMaxY() {
    if(!$this->maxy) {
      $this->maxy = sizeof($this->field[0]);      
    }
    return $this->maxy;
  }

  public function isAlive($x,$y) {
   if(isset($this->field[$x][$y])) {
   //if($x>=0 && $y>=0 && $x<$this->maxx && $y<$this->maxy) {
      
      if($this->field[$x][$y]==1) {
        return true;
      } else {
        return false;
      }
    }
	}

	public function setAlive($x,$y) {
		$this->field[$x][$y] = 1;
	}

	public function setDead($x,$y) {
		$this->field[$x][$y] = 0;
	}

  public function toggleStatus($x, $y) {
    if($this->isAlive($x,$y)) {
      $this->setDead($x, $y);
    } else {
      $this->setAlive($x, $y);      
    }
  }

  public function drawField() {
    $maxx = $this->getMaxX();
    $maxy = $this->getMaxY();
    
		$output = "<table>";
		for($i=0 ; $i < $maxx ; $i++){
			$output .= "<tr>";
			for($j=0 ; $j < $maxy ; $j++){
        $background = $this->getBackground($i,$j);
				$output .= "<td $background onclick='toggle($i,$j);'></td>";
			}
			$output .= "</tr>";
		}
		$output .= "</table>";

		return $output;
	}

	public function getBackground($x,$y) {
		if($this->isAlive($x, $y)) {
			return  "class='alive'";
		} else {
			return  "class='dead'";
		}
	}
        
  public function applyGameRules() {
    $maxx = $this->getMaxX();
    $maxy = $this->getMaxY();

    for($x=0 ; $x < $maxx ; $x++){
			for($y=0 ; $y < $maxy ; $y++){
        $count_neighbours = 0; 
        if($this->isAlive($x+1,$y+1)) {
          $count_neighbours++;
        }
        if($this->isAlive($x-1,$y-1)) {
          $count_neighbours++;
        }
        if($this->isAlive($x,$y+1)) {
          $count_neighbours++;
        }
        if($this->isAlive($x,$y-1)) {
          $count_neighbours++;
        }
        if($this->isAlive($x+1,$y)) {
          $count_neighbours++;
        }
        if($this->isAlive($x-1,$y)) {
          $count_neighbours++;
        }
        if($this->isAlive($x-1,$y+1)) {
          $count_neighbours++;
        }
        if($this->isAlive($x+1,$y-1)) {
          $count_neighbours++;
        }
        
        if($this->isAlive($x,$y)) {
          if($count_neighbours < 2){
            $this->field_temp[$x][$y] = 0;
          } elseif($count_neighbours > 3) {
            $this->field_temp[$x][$y] = 0;          
          } else {
            $this->field_temp[$x][$y] = 1;          
          }
        } else {
          if($count_neighbours == 3) {
            $this->field_temp[$x][$y] = 1;
          } else {
            $this->field_temp[$x][$y] = 0;
          }
        }
			}
		}
    $this->field = $this->field_temp;
  }
  
}
?>
