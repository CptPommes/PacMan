var level2 = new Array(20);
	for(var i = 0; i<level2.length; i++){
		level2[i] = new Array(15);
	}
	for(var i=0; i<20; i++){
		for(var j = 0; j<15; j++){
			if(i == 0 || j == 0 || i==19 || j == 14){
				level2[i][j] = "wand";
			} else
			 level2[i][j] = "punkt";
		}
	}

	level2[1][1] = "pstart";

	level2[2][2] = "wand";
	level2[4][2] = "wand";
	level2[6][2] = "wand";
	level2[8][2] = "wand";
	level2[11][2] = "wand";
	level2[13][2] = "wand";
	level2[15][2] = "wand";
	level2[17][2] = "wand";

	level2[3][4] = "wand";
	level2[5][4] = "wand";
	level2[7][4] = "wand";
	level2[9][4] = "wand";
	level2[10][4] = "wand";
	level2[12][4] = "wand";
	level2[14][4] = "wand";
	level2[16][4] = "wand";

	level2[2][6] = "wand";
	level2[4][6] = "wand";
	level2[6][6] = "wand";
	level2[8][6] = "wand";
	level2[11][6] = "wand";
	level2[13][6] = "wand";
	level2[15][6] = "wand";
	level2[17][6] = "wand";

	level2[3][8] = "wand";
	level2[5][8] = "wand";
	level2[7][8] = "wand";
	level2[9][8] = "wand";
	level2[10][8] = "wand";
	level2[12][8] = "wand";
	level2[14][8] = "wand";
	level2[16][8] = "wand";

	level2[2][10] = "wand";
	level2[4][10] = "wand";
	level2[6][10] = "wand";
	level2[8][10] = "wand";
	level2[11][10] = "wand";
	level2[13][10] = "wand";
	level2[15][10] = "wand";
	level2[17][10] = "wand";

	level2[3][12] = "wand";
	level2[5][12] = "wand";
	level2[7][12] = "wand";
	level2[9][12] = "wand";
	level2[10][12] = "wand";
	level2[12][12] = "wand";
	level2[14][12] = "wand";
	level2[16][12] = "wand";

	level2[7][6] = "frucht";
	level2[14][9] = "frucht";