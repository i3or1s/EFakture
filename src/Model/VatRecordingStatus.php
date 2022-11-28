<?php

namespace Boris\EFakture\Model;

enum VatRecordingStatus: string
{
    case DRAFT = 'Draft';
    case SENT = 'Sent';
}
