var level1 = new Array(20);
	for(var i = 0; i<level1.length; i++){
		level1[i] = new Array(15);
	}
	for(var i=0; i<20; i++){
		for(var j = 0; j<15; j++){
			if(i == 0 || j == 0 || i==19 || j == 14){
				level1[i][j] = "wand";
			} else
			 level1[i][j] = "punkt";
		}
	}

	level1[1][1] = "pstart";
	level1[2][3] = "wand";
	level1[2][4] = "wand";
	level1[2][5] = "wand";
	level1[3][2] = "wand";
	level1[4][2] = "wand";
	level1[2][2] = "wand";
	level1[2][2] = "wand";
	level1[5][2] = "wand";
	level1[6][2] = "wand";
	level1[7][2] = "wand";
	level1[8][2] = "wand";
	level1[2][6] = "wand";

	level1[17][12] = "wand";
	level1[16][12] = "wand";
	level1[15][12] = "wand";
	level1[14][12] = "wand";
	level1[13][12] = "wand";
	level1[12][12] = "wand";
	level1[11][12] = "wand";
	level1[17][11] = "wand";
	level1[17][10] = "wand";
	level1[17][9] = "wand";
	level1[17][8] = "wand";
	level1[17][3] = "wand";
	level1[17][4] = "wand";
	level1[17][5] = "wand";
	level1[17][6] = "wand";
	level1[17][2] = "wand";
	level1[16][2] = "wand";
	level1[15][2] = "wand";
	level1[14][2] = "wand";
	level1[13][2] = "wand";
	level1[12][2] = "wand";
	level1[11][2] = "wand";
	level1[2][12] = "wand";
	level1[3][12] = "wand";
	level1[4][12] = "wand";
	level1[5][12] = "wand";
	level1[6][12] = "wand";
	level1[7][12] = "wand";
	level1[8][12] = "wand";
	
	level1[2][11] = "wand";
	level1[2][10] = "wand";
	level1[2][9] = "wand";
	level1[2][8] = "wand";

	level1[6][4] = "wand";
	level1[6][5] = "wand";
	level1[6][6] = "wand";
	level1[5][6] = "wand";
	level1[4][6] = "wand";

	level1[6][8] = "wand";
	level1[6][9] = "wand";
	level1[6][10] = "wand";
	level1[5][8] = "wand";
	level1[4][8] = "wand";

	level1[13][4] = "wand";
	level1[13][5] = "wand";
	level1[13][6] = "wand";
	level1[14][6] = "wand";
	level1[15][6] = "wand";

	level1[13][8] = "wand";
	level1[13][9] = "wand";
	level1[13][10] = "wand";
	level1[14][8] = "wand";
	level1[15][8] = "wand";

	level1[8][5] = "wand";
	level1[9][6] = "wand";
	level1[10][6] = "wand";
	level1[11][5] = "wand";

	level1[8][9] = "wand";
	level1[9][8] = "wand";
	level1[10][8] = "wand";
	level1[11][9] = "wand";

	level1[3][7] = "frucht";
	level1[16][7] = "frucht";