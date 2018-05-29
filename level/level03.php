var level3 = new Array(20);
	for(var i = 0; i<level3.length; i++){
		level3[i] = new Array(15);
	}
	for(var i=0; i<20; i++){
		for(var j = 0; j<15; j++){
			if(i == 0 || j == 0 || i==19 || j == 14){
				level3[i][j] = "wand";
			} else
			 level3[i][j] = "punkt";
		}
	}

	level3[1][1] = "pstart";
	level3[4][2] = "wand";
	level3[4][3] = "wand";
	level3[4][4] = "wand";
	level3[3][4] = "wand";
	level3[2][4] = "wand";

	level3[4][12] = "wand";
	level3[4][11] = "wand";
	level3[4][10] = "wand";
	level3[3][10] = "wand";
	level3[2][10] = "wand";

	level3[15][12] = "wand";
	level3[15][11] = "wand";
	level3[15][10] = "wand";
	level3[16][10] = "wand";
	level3[17][10] = "wand";

	level3[15][2] = "wand";
	level3[15][3] = "wand";
	level3[15][4] = "wand";
	level3[16][4] = "wand";
	level3[17][4] = "wand";

	level3[6][5] = "wand";
	level3[7][5] = "wand";
	level3[8][5] = "wand";
	level3[6][6] = "wand";
	level3[6][7] = "wand";
	level3[6][8] = "wand";
	level3[6][9] = "wand";
	level3[7][9] = "wand";
	level3[8][9] = "wand";

	level3[11][9] = "wand";
	level3[12][9] = "wand";
	level3[13][9] = "wand";
	level3[13][8] = "wand";
	level3[13][7] = "wand";
	level3[13][6] = "wand";
	level3[13][5] = "wand";
	level3[12][5] = "wand";
	level3[11][5] = "wand";

	level3[10][7] = "wand";
	level3[9][7] = "wand";
	level3[8][7] = "wand";
	level3[11][7] = "wand";

	level3[3][3] = "frucht";
	level3[3][11] = "frucht";
	level3[16][3] = "frucht";
	level3[16][11] = "frucht";
