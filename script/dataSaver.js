import * as jQuery from "/libraries/jquery-1.9.0.min.js";
import ColorUtils from "/script/colorUtils.js";
import {getChartID, getCurrentBgColor, getCurrentPickedColor, getCurrentActualColor, CANVAS_ID} from "/script/colourContrast.js";

export default class DataSaver{
    static addData(actualTime){
        var colors = new ColorUtils(getCurrentPickedColor(), getCurrentActualColor());
        return $.post("functions/saveResults.php?action=add",{
            chart_id: getChartID(),
            bg_color: getCurrentBgColor().toHexString(),
            actual_color: getCurrentActualColor().toHexString(),
            picked_color: getCurrentPickedColor().toHexString(),
            euclid_dist: colors.getRGBEuclidDist(),
            hue_dist: colors.getHueDist(),
            saturation_dist: colors.getSatDist(),
            luma_dist: colors.getLumaDist(),
            hue_delta: colors.getHueDelta(),
            saturation_delta: colors.getSatDelta(),
            luma_delta: colors.getLumaDelta(),
            time: actualTime
        }).done(this.saveImage());
    }

    static saveImage(){
        var canvas = document.getElementById(CANVAS_ID);
        return $.post("functions/saveResults.php?action=image",{
            chart_id: getChartID(),
            img_base64: canvas.toDataURL("image/png")
        });
    }
}