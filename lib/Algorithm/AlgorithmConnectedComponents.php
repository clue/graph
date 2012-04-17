<?php

class AlgorithmConnectedComponents{
	
	/**
	 * 
	 * @var Graph
	 */
	private $graph;
	
	/**
	 * 
	 * @param Graph $graph
	 */
	public function __construct($graph){
		$this->graph = $graph;
	}
	
	/**
	 * check whether this graph consists of only a single component
	 * 
	 * could be improved by not checking for actual number of components but stopping when there's more than one
	 * 
	 * @return boolean
	 * @uses AlgorithmConnectedComponents::getNumberOfComponents()
	 */
	public function isSingle(){
	    return ($this->getNumberOfComponents() === 1);
	}
	
	/**
	 * @return int number of components
	 * @uses Graph::getVertices()
	 * @uses Vertex::searchBreadthFirst()
	 */
	public function getNumberOfComponents(){
		$visitedVertices = array();
		$components = 0;
		
		foreach ($this->graph->getVertices() as $vertex){						//for each vertices
			if ( ! isset( $visitedVertices[$vertex->getId()] ) ){					//did I visit this vertex before?
				
				$newVertices = $vertex->searchBreadthFirst();							//get all vertices of this component
				
				$components++;
				
				foreach ($newVertices as $v){											//mark the vertices of this component as visited
					$visitedVertices[$v->getId()] = true;
				}
			}
		}
		
		return $components;														//return number of components
	}
}