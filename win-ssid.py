# -*- encoding: utf-8 -*-

import os, re

def getSSID():
    result = os.popen('netsh wlan show interfaces')
    ssids = []
    lines = result.readlines()
    if len(lines) > 0:
        for str in lines:
            m = re.match('\s*SSID\s*:\s*(.*)\\n$', str, re.IGNORECASE)
            if m:
                ssids.append(m.groups()[0])
    result.seek(0)
    
    return ssids
