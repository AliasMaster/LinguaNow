import { onchangeCheckBox, selectAllCheckBoxes } from './checkBoxes.js';
import { deleteRows, deleteInDatabase, cancel } from './deleteRows.js';
import { edit, updateInDatabase } from './edit.js';
import { addMessage, sendMessage } from './addMessage.js';

// checkBoxes
window.onchangeCheckBox = onchangeCheckBox;
window.selectAllCheckBoxes = selectAllCheckBoxes;

// edit
window.edit = edit;
window.updateInDatabase = updateInDatabase;

// deleteRows
window.deleteRows = deleteRows;
window.cancel = cancel;
window.deleteInDatabase = deleteInDatabase;

// addMessage
window.addMessage = addMessage;
window.sendMessage = sendMessage;
