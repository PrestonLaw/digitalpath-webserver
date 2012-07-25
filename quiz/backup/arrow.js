
function Arrow() {
    Shape.call(this);
    this.Width = 10; // width of the shaft and size of the head
    this.Length = 50; // Length of the arrow in pixels
    this.Orientation = 45.0; // in degrees, counter clockwise, 0 is left
    this.Origin = [10000,10000]; // Tip position in world coordinates.
};
Arrow.prototype = new Shape;


Arrow.prototype.destructor=function() {
    // Get rid of the buffers?
}


Arrow.prototype.UpdateBuffers = function() {
    var vertexPositionData = [];
    var cellData = [];
    var hw = this.Width * 0.5;
    var w2 = this.Width * 2.0;

    this.Matrix = mat4.create();
    mat4.identity(this.Matrix);

    vertexPositionData.push(0.0);
    vertexPositionData.push(0.0);
    vertexPositionData.push(0.0);

    vertexPositionData.push(w2);
    vertexPositionData.push(this.Width);
    vertexPositionData.push(0.0);

    vertexPositionData.push(w2);
    vertexPositionData.push(hw);
    vertexPositionData.push(0.0);

    vertexPositionData.push(this.Length);
    vertexPositionData.push(hw);
    vertexPositionData.push(0.0);

    vertexPositionData.push(this.Length);
    vertexPositionData.push(-hw);
    vertexPositionData.push(0.0);

    vertexPositionData.push(w2);
    vertexPositionData.push(-hw);
    vertexPositionData.push(0.0);

    vertexPositionData.push(w2);
    vertexPositionData.push(-this.Width);
    vertexPositionData.push(0.0);

    vertexPositionData.push(0.0);
    vertexPositionData.push(0.0);
    vertexPositionData.push(0.0);

    // Now create the triangles    
    cellData.push(0);
    cellData.push(1);
    cellData.push(2);
    
    cellData.push(0);
    cellData.push(2);
    cellData.push(5);
    
    cellData.push(0);
    cellData.push(5);
    cellData.push(6);
    
    cellData.push(2);
    cellData.push(3);
    cellData.push(4);
    
    cellData.push(2);
    cellData.push(4);
    cellData.push(5);

    this.VertexPositionBuffer = GL.createBuffer();
    GL.bindBuffer(GL.ARRAY_BUFFER, this.VertexPositionBuffer);
    GL.bufferData(GL.ARRAY_BUFFER, new Float32Array(vertexPositionData), GL.STATIC_DRAW);
    this.VertexPositionBuffer.itemSize = 3;
    this.VertexPositionBuffer.numItems = vertexPositionData.length / 3;
    
    this.CellBuffer = GL.createBuffer();
    GL.bindBuffer(GL.ELEMENT_ARRAY_BUFFER, this.CellBuffer);
    GL.bufferData(GL.ELEMENT_ARRAY_BUFFER, new Uint16Array(cellData), GL.STATIC_DRAW);
    this.CellBuffer.itemSize = 1;
    this.CellBuffer.numItems = cellData.length;
}