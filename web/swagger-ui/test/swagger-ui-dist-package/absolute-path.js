/* eslint-env mocha */
import expect from "expect"
import path from "path"
import getAbsoluteFSPath from "../../swagger-ui-dist-package/absolute-path"

describe("swaegger-ui-dist", function(){
  describe("getAbsoluteFSPath", function(){
    it("returns absolute path", function(){
      const expectedPath = path.resolve(__dirname, "../../swaegger-ui-dist-package")
      expect(getAbsoluteFSPath()).toEqual(expectedPath)
    })
  })
})
